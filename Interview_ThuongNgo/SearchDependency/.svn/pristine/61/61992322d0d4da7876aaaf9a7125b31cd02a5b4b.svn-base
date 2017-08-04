package models;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by nnmthuong on 04/26/2017.
 */
public class DependencyVO {
    private String m_artifactId;
    private String m_groupId;
    private String m_version;
    private List<DependencyVO> m_dependencies;

    public String getArtifactId() {
        return m_artifactId;
    }

    public void setArtifactId(String artifactId) {
        m_artifactId = artifactId;
    }

    public String getGroupId() {
        return m_groupId;
    }

    public void setGroupId(String groupId) {
        m_groupId = groupId;
    }

    public String getVersion() {
        return m_version;
    }

    public void setVersion(String version) {
        m_version = version;
    }

    public List<DependencyVO> getDependencies() {
        if(m_dependencies == null){
            m_dependencies = new ArrayList<DependencyVO>();
        }
        return m_dependencies;
    }

    public void setDependencies(List<DependencyVO> dependencies) {
        m_dependencies = dependencies;
    }

    @Override
    public String toString() {
        return "DependencyVO{" +
                "m_artifactId='" + m_artifactId + '\'' +
                ", m_groupId='" + m_groupId + '\'' +
                ", m_version='" + m_version + '\'' +
                ", m_dependencies=" + m_dependencies +
                '}';
    }
}
