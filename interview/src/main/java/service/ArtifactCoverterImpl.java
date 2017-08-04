package service;

import models.DependencyVO;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
import util.Constant;
import util.XmlUtil;

import java.util.ArrayList;
import java.util.List;

public class ArtifactCoverterImpl implements ArtifactCoverter {
    @Override
    public DependencyVO getDependencyVO(String xmlStr) {
        DependencyVO dependencyVO = new DependencyVO();
        Document document = XmlUtil.convertStringToDocument(xmlStr);

        if (document != null) {
            NodeList projectNodeList = document.getElementsByTagName(Constant.PROJECT_ELEMENT_TAG);
            Node projectNode = projectNodeList.item(0);

            if (projectNode.getNodeType() == Node.ELEMENT_NODE) {
                Element projectElement = (Element) projectNode;
                dependencyVO.setM_artifactId(projectElement.getElementsByTagName(Constant.ARTIFACT_ID).item(1).getTextContent());
                dependencyVO.setM_groupId(projectElement.getElementsByTagName(Constant.GROUP_ID).item(1).getTextContent());
                dependencyVO.setM_version(projectElement.getElementsByTagName(Constant.VERSION).item(1).getTextContent());
            }

            NodeList dependencyNodeList = document.getElementsByTagName(Constant.DEPENDENCY_ELEMENT_TAG);
            List<DependencyVO> dependencyVOList = new ArrayList<>();
            for (int i = 0; i < dependencyNodeList.getLength(); i++) {
                DependencyVO dependency = new DependencyVO();
                Node node = dependencyNodeList.item(i);
                if (node.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) node;
                    dependency.setM_artifactId(element.getElementsByTagName(Constant.ARTIFACT_ID).item(0).getTextContent());
                    dependency.setM_groupId(element.getElementsByTagName(Constant.GROUP_ID).item(0).getTextContent());
                    dependency.setM_version(element.getElementsByTagName(Constant.VERSION).item(0).getTextContent());
                    dependencyVOList.add(dependency);
                }
            }
            dependencyVO.setM_listDependency(dependencyVOList);
        }
        return dependencyVO;
    }

    @Override
    public String getGroupIdFromPomFile(String xmlStr) {
        Document doc = XmlUtil.convertStringToDocument(xmlStr);
        try {
            if (doc != null) {
                NodeList artifactNodeList = doc.getElementsByTagName(Constant.ARTIFACT_ELEMENT_TAG);
                Node node = artifactNodeList.item(0);
                if (node.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) node;
                    return element.getElementsByTagName(Constant.GROUP_ID).item(0).getTextContent();
                }
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
        return Constant.EMPTY_STRING;
    }
}
