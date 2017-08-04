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

    public void setM_type(String m_groupId) {
        if (m_groupId.contains(TYPE_CORE)) {
            this.m_type = CORE;
        } else if (m_groupId.contains(TYPE_APC)) {
            this.m_type = APC;
        } else if (m_groupId.contains(TYPE_GSIP)) {
            this.m_type = GSIP;
        } else if (m_groupId.contains(TYPE_IDM)) {
            this.m_type = IDM;
        } else if (m_groupId.contains(TYPE_OIF)) {
            this.m_type = OIF;
        } else if (m_groupId.contains(TYPE_SPFE)) {
            this.m_type = SPFE;
        } else {
            this.m_type = "";
        }
    }

    public String getM_type() {
        return m_type;
    }

    public String toString() {
        StringBuffer buffer = new StringBuffer();
        if (this.m_listDependency != null) {
            if (this.m_type.equals(CORE)) {
                write(buffer, OPEN_CORE, CLOSE_CORE);
            } else if (this.m_type.equals(APC)) {
                write(buffer, OPEN_APC, CLOSE_APC);
            } else if (this.m_type.equals(GSIP)) {
                write(buffer, OPEN_GSIP, CLOSE_GSIP);
            } else if (this.m_type.equals(IDM)) {
                write(buffer, OPEN_IDM, CLOSE_IDM);
            } else if (this.m_type.equals(SPFE)) {
                write(buffer, OPEN_SPFE, CLOSE_SPFE);
            } else {
                write(buffer, "<Combo>", "</Combo>");
            }
        } else {
            writeDependency(buffer, this);
        }
        return buffer.toString();
    }

    private void write(StringBuffer buffer, String open, String close) {
        buffer.append(TAB + open + LINE_DOWN);
        buffer.append(TAB + TAB + OPEN_DENPENDENCIES + LINE_DOWN);

        for (int i = 0; i < this.m_listDependency.size(); i++) {
            DependencyVO vo = this.m_listDependency.get(i);
            if (vo.m_type.equals(CORE)) {
                writeDepen(buffer, vo, OPEN_CORE, CLOSE_CORE);
            } else if (vo.m_type.equals(APC)) {
                writeDepen(buffer, vo, OPEN_APC, CLOSE_APC);
            } else if (vo.m_type.equals(GSIP)) {
                writeDepen(buffer, vo, OPEN_GSIP, CLOSE_GSIP);
            } else if (vo.m_type.equals(IDM)) {
                writeDepen(buffer, vo, OPEN_IDM, CLOSE_IDM);
            } else if (vo.m_type.equals(SPFE)) {
                writeDepen(buffer, vo, OPEN_SPFE, CLOSE_SPFE);
            }
        }

        buffer.append(TAB + TAB + CLOSE_DENPENDENCIES + LINE_DOWN);
        buffer.append(TAB + close + LINE_DOWN);
    }

    private void writeDepen(StringBuffer buffer, DependencyVO vo, String open, String close) {
        buffer.append(TAB + TAB + TAB + open + LINE_DOWN);

        if (vo.getM_listDependency() != null) {
            for (int j = 0; j < vo.getM_listDependency().size(); j++) {
                DependencyVO de = vo.getM_listDependency().get(j);
                writeDependency(buffer, de);
            }
        } else {
            writeDependency(buffer, vo);
        }
        buffer.append(TAB + TAB + TAB + close + LINE_DOWN);
    }

    private void writeDependency(StringBuffer buffer, DependencyVO dependencyVO) {
        if (dependencyVO.getM_groupId().contains(COM_ALCATEL)) {
            buffer.append(TAB + TAB + TAB + TAB + OPEN_DENPENDENCY + LINE_DOWN);
            
            buffer.append(TAB + TAB + TAB + TAB + TAB + OPEN_GROUPID);
            buffer.append(dependencyVO.m_groupId);
            buffer.append(CLOSE_GROUPID + LINE_DOWN);

            buffer.append(TAB + TAB + TAB + TAB + TAB + OPEN_ARTIFACTID);
            buffer.append(dependencyVO.m_artifactId);
            buffer.append(CLOSE_ARTIFACTID + LINE_DOWN);

            buffer.append(TAB + TAB + TAB + TAB + TAB + OPEN_VERSION);
            buffer.append(dependencyVO.m_version);
            buffer.append(CLOSE_VERSION + LINE_DOWN);

            buffer.append(TAB + TAB + TAB + TAB + CLOSE_DENPENDENCY + LINE_DOWN);
        }
    }
}
