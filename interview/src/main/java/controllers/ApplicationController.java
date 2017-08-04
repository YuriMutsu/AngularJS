/**
 * Copyright (C) 2013 the original author or authors.
 * <p>
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * <p>
 * http://www.apache.org/licenses/LICENSE-2.0
 * <p>
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package controllers;

import handler.SearchDependencyHandler;
import models.DependencyVO;
import ninja.Result;
import ninja.Results;

import com.google.inject.Singleton;
import ninja.params.Param;
import org.json.JSONArray;
import org.json.JSONObject;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import service.ArtifactCoverterImpl;
import service.DependencySearcherImpl;

import javax.swing.*;
import java.io.*;
import java.util.ArrayList;
import java.util.List;

import static handler.SearchDependencyHandler.checkNull;
import static util.Constant.*;


@Singleton
public class ApplicationController {
    private static final Logger m_logger = LoggerFactory.getLogger(ApplicationController.class);
    private SearchDependencyHandler m_searchDependencyHandler = new SearchDependencyHandler();

    public Result index() {

        return Results.html();
    }

    public Result searchDenpendency(@Param("binaryName") String binaryName) {
        try {
            DependencyVO dependencyVO = m_searchDependencyHandler.searchDependency(binaryName);

            if (checkNull(dependencyVO)) {
                m_logger.info("Error! Can not find out dependency: " + dependencyVO);
                return Results.json().render("ERROR");
            } else {
                m_logger.info("Result dependency: " + dependencyVO);
                return Results.json().render(dependencyVO);
            }
        } catch (Exception e) {
            m_logger.error("Exception while find dependency for combo plug", e);
            return Results.json().render(e.toString());
        }
    }


    public Result getDependencySecondLevelInfo(@Param("data") String data) {
        try {
            DependencyVO dependencyVO = m_searchDependencyHandler.getDependencySecondLevelInfo(data);
            if (checkNull(dependencyVO)) {
                m_logger.error("Can not find out the dependency on each combo plug: " + dependencyVO);
                return Results.json().render("ERROR");
            } else {
                m_logger.info("Find out the dependency on each plug: " + dependencyVO);
                return Results.json().render(dependencyVO);
            }
        } catch (Exception e) {
            m_logger.error("Exception while find the next level dependency for all components", e);
            return Results.json().render(e.toString());
        }
    }
    
    public Result exportFileXml(@Param("groupId") String groupId,
                                @Param("artifactId") String artifactId,
                                @Param("version") String version) {
        DependencySearcherImpl dependencySearcher = new DependencySearcherImpl();
        ArtifactCoverterImpl artifactCoverter = new ArtifactCoverterImpl();
        String strXml = dependencySearcher.getPomContent(groupId, artifactId, version);
        DependencyVO dependencyVO = artifactCoverter.getDependencyVO(strXml);

        if (dependencyVO.getM_listDependency() != null) {
            JSONObject object;
            List<DependencyVO> list = dependencyVO.getM_listDependency();
            for (int i = 0; i < list.size(); i++) {
                DependencyVO vo = list.get(i);

                object = new JSONObject();
                object.put("type", vo.getM_type());
                object.put("groupId", vo.getM_groupId());
                object.put("version", vo.getM_version());

                String artifactIdTemp = vo.getM_artifactId();

                String[] newArtifactId = artifactIdTemp.split("-");
                if (newArtifactId.length == 1) {
                    artifactIdTemp = newArtifactId[0];
                } else if (newArtifactId.length == 2) {
                    artifactIdTemp = newArtifactId[1];
                }

                object.put("artifactId", artifactIdTemp);

                DependencyVO de = m_searchDependencyHandler.getDependencySecondLevelInfo(object.toString());
                vo.setM_listDependency(de.getM_listDependency());

                System.out.println(vo.getM_type() + " ==== " +vo.getM_listDependency().size());
            }
        }

        StringBuffer buffer = new StringBuffer();

        buffer.append(OPEN_GROUPID);
        buffer.append(dependencyVO.getM_groupId());
        buffer.append(CLOSE_GROUPID + LINE_DOWN);

        buffer.append(OPEN_ARTIFACTID);
        buffer.append(dependencyVO.getM_artifactId());
        buffer.append(CLOSE_ARTIFACTID + LINE_DOWN);

        buffer.append(OPEN_VERSION);
        buffer.append(dependencyVO.getM_version());
        buffer.append(CLOSE_VERSION + LINE_DOWN);

        buffer.append(dependencyVO.toString());

        JSONObject json = new JSONObject();

        FileOutputStream out = null;

        try {
            out = new FileOutputStream("D:\\pom.xml");

            for (char c:buffer.toString().toCharArray()){
                out.write(c);
            }
            out.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

        json.put("data", buffer.toString());

        return Results.text().render(json);
    }
}