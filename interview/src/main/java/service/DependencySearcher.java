package service;

import java.util.HashMap;

public interface DependencySearcher {
    HashMap<String, String> getArtifactIdVersion(String binaryName);

    String getPomContent(String artifactId, String version);

    String getPomContent(String group, String artifactId, String version);
}
