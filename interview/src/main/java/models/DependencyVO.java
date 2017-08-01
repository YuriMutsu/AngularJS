package models;

import java.util.List;

public class DependencyVO {
    private String m_artifactId;
    private String m_groupId;
    private String m_version;
    List<DependencyVO> m_listDependency;

    public DependencyVO() {
    }

    public DependencyVO(String m_artifactId, String m_groupId, String m_version) {
        this.m_artifactId = m_artifactId;
        this.m_groupId = m_groupId;
        this.m_version = m_version;
    }

    public DependencyVO(String m_artifactId, String m_groupId, String m_version, List<DependencyVO> m_listDependency) {
        this.m_artifactId = m_artifactId;
        this.m_groupId = m_groupId;
        this.m_version = m_version;
        this.m_listDependency = m_listDependency;
    }

    public String getM_artifactId() {
        return m_artifactId;
    }

    public void setM_artifactId(String m_artifactId) {
        this.m_artifactId = m_artifactId;
    }

    public String getM_groupId() {
        return m_groupId;
    }

    public void setM_groupId(String m_groupId) {
        this.m_groupId = m_groupId;
    }

    public String getM_version() {
        return m_version;
    }

    public void setM_version(String m_version) {
        this.m_version = m_version;
    }

    public List<DependencyVO> getM_listDependency() {
        return m_listDependency;
    }

    public void setM_listDependency(List<DependencyVO> m_listDependency) {
        this.m_listDependency = m_listDependency;
    }
}
