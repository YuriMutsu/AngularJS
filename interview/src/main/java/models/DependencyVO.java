package models;

import java.util.List;

import static util.Constant.*;

public class DependencyVO {
    private String m_artifactId;
    private String m_groupId;
    private String m_version;
    private String m_type;

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
        setM_type(m_groupId);
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

    private void setM_type(String m_groupId){
        if (m_groupId.contains(TYPE_CORE)){
            this.m_type = CORE;
        }else if (m_groupId.contains(TYPE_APC)){
            this.m_type = APC;
        }else if (m_groupId.contains(TYPE_GSIP)){
            this.m_type = GSIP;
        }else if (m_groupId.contains(TYPE_IDM)){
            this.m_type = IDM;
        }else if (m_groupId.contains(TYPE_OIF)){
            this.m_type = OIF;
        }else if (m_groupId.contains(TYPE_SPFE)){
            this.m_type = SPFE;
        }else{
            this.m_type = "";
        }
    }

    public String getM_type() {
        return m_type;
    }

    public String toString(){
        StringBuffer buffer = new StringBuffer();
        DependencyVO dependencyVO;
        if (this.m_listDependency != null){
            for (int i=0;i<this.m_listDependency.size(); i++){
                dependencyVO = this.m_listDependency.get(i);
                if (dependencyVO.getM_listDependency() == null){
                    buffer.append(writeXML(dependencyVO));
                }else{
                    buffer.append(writeXML(dependencyVO));
                    for (int j=0;j<dependencyVO.getM_listDependency().size(); j++){
                        buffer.append(writeXML(dependencyVO.getM_listDependency().get(j)));
                    }
                }
            }
        }
        return buffer.toString();
    }

    private String writeXML(DependencyVO dependencyVO){
        StringBuffer buffer = new StringBuffer();
        buffer.append(OPEN_DENPENDENCY + LINE_DOWN);

        buffer.append(OPEN_GROUPID);
        buffer.append(dependencyVO.m_groupId);
        buffer.append(CLOSE_GROUPID + LINE_DOWN);

        buffer.append(OPEN_ARTIFACTID);
        buffer.append(dependencyVO.m_artifactId);
        buffer.append(CLOSE_ARTIFACTID + LINE_DOWN);

        buffer.append(OPEN_VERSION);
        buffer.append(dependencyVO.m_version);
        buffer.append(CLOSE_VERSION + LINE_DOWN);

        buffer.append(CLOSE_DENPENDENCY + LINE_DOWN);

        return buffer.toString();
    }
}
