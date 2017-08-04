package service;

import java.util.HashMap;
/**
 * This class is used to contact to Nexus to retrieve the needed information
 */
public interface DependencySearcher {
    HashMap<String, String> getArtifactIdVersion(String binaryName);

    /**
     * It retrieve the first level pom inside the plug or vap from Nexus
     * Notice that it is not the maven pom file
     * @param artifactId
     * @param version
     * @return
     */
    String getPomContent(String artifactId, String version);

    /**
     * It retrieve the child level pom of the vap/plug's dependency  Nexus, it is the maven pom
     * @param group
     * @param artifactId
     * @param version
     * @return
     */
    String getPomContent(String group, String artifactId, String version);
}
