package service;

import models.DependencyVO;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
import util.Constant;
import util.XmlUtil;

import java.util.ArrayList;
import java.util.List;

public class ArtifactConvertImpl implements ArtifactConverter {
    private static final Logger m_logger = LoggerFactory.getLogger(ArtifactConvertImpl.class);

    public DependencyVO getDependencyVO(String xmlStr) {
        DependencyVO dependencyVO = null;
        try {
            dependencyVO = new DependencyVO();
            Document doc = XmlUtil.convertStringToDocument(xmlStr);
            if (null != doc) {
                NodeList projectNodeList = doc.getElementsByTagName(Constant.PROJECT_ELEMENT_TAG);
                Node projectNode = projectNodeList.item(0);
                if (projectNode.getNodeType() == Node.ELEMENT_NODE) {
                    Element projectElement = (Element) projectNode;
                    dependencyVO.setArtifactId(projectElement.getElementsByTagName(Constant.ARTIFACT_ID).item(1).getTextContent());
                    dependencyVO.setGroupId(projectElement.getElementsByTagName(Constant.GROUP_ID).item(1).getTextContent());
                    dependencyVO.setVersion(projectElement.getElementsByTagName(Constant.VERSION).item(1).getTextContent());
                }

                NodeList dependencyNodeList = doc.getElementsByTagName(Constant.DEPENDENCY_ELEMENT_TAG);
                List<DependencyVO> dependencyVOs = new ArrayList<>();
                for (int i = 0; i < dependencyNodeList.getLength(); i++) {
                    DependencyVO dependencyVOTemp = new DependencyVO();
                    Node node = dependencyNodeList.item(i);
                    if (node.getNodeType() == Node.ELEMENT_NODE) {
                        Element eElement = (Element) node;
                        dependencyVOTemp.setArtifactId(eElement.getElementsByTagName(Constant.ARTIFACT_ID).item(0).getTextContent());
                        dependencyVOTemp.setGroupId(eElement.getElementsByTagName(Constant.GROUP_ID).item(0).getTextContent());
                        dependencyVOTemp.setVersion(eElement.getElementsByTagName(Constant.VERSION).item(0).getTextContent());
                        dependencyVOs.add(dependencyVOTemp);
                    }
                }
                dependencyVO.setDependencies(dependencyVOs);
            }
        } catch (Exception e) {
            m_logger.error("Get DependencyVO failed: ", e);
        }
        return dependencyVO;
    }

    public String getGroupIdFromPomFile(String xmlStr) {
        Document doc = XmlUtil.convertStringToDocument(xmlStr);
        try {
            if (null != doc) {
                NodeList artifactNodeList = doc.getElementsByTagName(Constant.ARTIFACT_ELEMENT_TAG);
                Node node = artifactNodeList.item(0);
                if (node.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) node;
                    return element.getElementsByTagName(Constant.GROUP_ID).item(0).getTextContent();
                }
            }
        } catch (Exception e) {
            m_logger.error("Get groupId from pom file failed: ", e);
        }
        return Constant.EMPTY_STRING;
    }
}
