package service;

import models.DependencyVO;

import java.util.List;

/**
 * This class is used to convert the raw data i.e. xml string which is retrieved from the nexus into the VO
 */
public interface ArtifactConverter {
    /**
     * This method use to get DependencyVO info from pom file
     *
     * @param xmlStr a string with xml format
     * @return DependencyVo
     */
    DependencyVO getDependencyVO(String xmlStr);

    /**
     * This method use to get groupId from pom file
     *
     * @param xmlStr a string with xml format
     * @return groupId
     */
    String getGroupIdFromPomFile(String xmlStr);
}
