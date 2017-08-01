package service;

import models.DependencyVO;

public interface ArtifactCoverter {
    DependencyVO getDependencyVO(String xmlStr);

    String getGroupIdFromPomFile(String xmlStr);
}
