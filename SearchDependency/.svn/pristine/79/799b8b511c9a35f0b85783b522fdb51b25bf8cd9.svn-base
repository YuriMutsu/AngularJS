package controllers;

import com.google.inject.Singleton;
import handler.SearchDependencyHandler;
import models.DependencyVO;
import models.ResultCode;
import ninja.Result;
import ninja.Results;
import ninja.params.Param;
import org.json.JSONObject;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import service.ArtifactConvertImpl;
import service.DependencySearcherImpl;
import service.RequestHandler;
import util.Constant;
import util.ResultConverter;
import util.XmlUtil;
import static handler.SearchDependencyHandler.checkNull;

@Singleton
public class SearchDependencyController {
    private static final Logger m_logger = LoggerFactory.getLogger(SearchDependencyController.class);
    private SearchDependencyHandler m_searchDependencyHandler = new SearchDependencyHandler();
    private DependencySearcherImpl m_dependencySearcherImpl = new DependencySearcherImpl();

    public Result dependency() {
        return Results.html();
    }

    public Result searchDependency(@Param("binaryName") String binaryName) {
        try {
            DependencyVO dependencyVO = m_searchDependencyHandler.searchDependency(binaryName);
            if (checkNull(dependencyVO)) {
                m_logger.info("Error! Can not find out dependency: " + dependencyVO);
                return ResultConverter.convertToResult(ResultCode.ERROR, dependencyVO);
            } else {
                m_logger.info("Result dependency: " + dependencyVO);
                return ResultConverter.convertToResult(ResultCode.SUCCESS, dependencyVO);
            }
        } catch (Exception e) {
            m_logger.error("Exception while find dependency for combo plug", e);
            return Results.internalServerError();
        }
    }

    public Result getDependencySecondLevelInfo(@Param("data") String data) {
        try {
            // m_logger.info("data : " + data);
            DependencyVO dependencyVO = m_searchDependencyHandler.getDependencySecondLevelInfo(data);
            if (checkNull(dependencyVO)) {
                m_logger.error("Can not find out the dependency on each combo plug: " + dependencyVO);
                return ResultConverter.convertToResult(ResultCode.ERROR, dependencyVO);
            } else {
                m_logger.info("Find out the dependency on each plug: " + dependencyVO);
                return ResultConverter.convertToResult(ResultCode.SUCCESS, dependencyVO);
            }
        } catch (Exception e) {
            m_logger.error("Exception while find the next level dependency for all components", e);
            return Results.internalServerError();
        }
    }

    private DependencyVO getDependency(String groupId, String artifactId, String version) {
        String contentFirstPomFile = m_dependencySearcherImpl.getPomContent(groupId, artifactId, version);
        ArtifactConvertImpl artifactConvert = new ArtifactConvertImpl();
        DependencyVO dependencyVO = null;
        try {
            dependencyVO = artifactConvert.getDependencyVO(contentFirstPomFile);
        } catch (Exception e) {
            return null;
        }
        if (dependencyVO == null) {
            return null;
        }
        if (dependencyVO.getDependencies() == null || dependencyVO.getDependencies().isEmpty()) {
            return dependencyVO;
        }
        for (DependencyVO childDependencyVO : dependencyVO.getDependencies()) {
            String group = childDependencyVO.getGroupId();
            String artifact = childDependencyVO.getArtifactId();
            String ver = childDependencyVO.getVersion();
            if (group == null || artifact == null) {
                continue;
            }
            // m_logger.info("artifact: " + artifact);
            String newArtifact[] = artifact.split("-");
            String artifact2 = "";
            String type = "";
            if (newArtifact.length == 1) {
                artifact2 = newArtifact[0];
                type = "CORE";
            } else if (newArtifact.length == 2) {
                artifact2 = newArtifact[1];
                type = newArtifact[0].toUpperCase();
            }
            if (artifact2.isEmpty()) {
                continue;
            }
            RequestHandler requestHandler = new RequestHandler();
            String finalArtifact = null;
            try {
                finalArtifact = requestHandler.parser(type, artifact2, version);
            } catch (Exception e) {
            }
            if (finalArtifact == null || finalArtifact.isEmpty()) {
                continue;
            }
            String[] finalArtifacts = finalArtifact.split(",");
            for (String artfact : finalArtifacts) {
                DependencyVO nextDependency = getDependency(group, artfact, ver);
                if (nextDependency != null) {
                    childDependencyVO.getDependencies().addAll(nextDependency.getDependencies());
                }
            }
        }
        return dependencyVO;
    }

    public Result exportXML(@Param("data") String data) {
        try {
            // m_logger.info("data : " + data);
            JSONObject jsonObject = new JSONObject(data);
            String groupId = jsonObject.get(Constant.GROUP_ID).toString();
            String artifactId = jsonObject.get(Constant.ARTIFACT_ID).toString();
            String version = jsonObject.get(Constant.VERSION).toString();
            DependencyVO dependencyVO = getDependency(groupId, artifactId, version);
             m_logger.info("Export the dependency as XML successfully!");
            return ResultConverter.convertToResult(ResultCode.SUCCESS, XmlUtil.exportToXml(dependencyVO));
        } catch (Exception e) {
            m_logger.error("Exception while export dependency for all components", e);
            return Results.internalServerError();
        }
    }
}

