package handler;

import models.DependencyVO;

import static org.junit.Assert.assertEquals;

import org.junit.Before;
import org.junit.Test;

public class SearchDependencyHandlerTest {
    private SearchDependencyHandler m_searchDependencyHandler;
    private DependencyVO m_dependencyVO;

    @Before
    public void setUp() {
        m_searchDependencyHandler = new SearchDependencyHandler();
        m_dependencyVO = new DependencyVO();
    }

    @Test
    public void testSearchDependency() {
        String binaryName = "plugin-combo-isam-5.5-2.0_9.5-352252.bin";
        m_dependencyVO = m_searchDependencyHandler.searchDependency(binaryName);
        assertEquals("com.alcatel.axs.combo.plugins.isam.5.5", m_dependencyVO.getGroupId());
        assertEquals("comboisam", m_dependencyVO.getArtifactId());
        assertEquals("5.5-2_9.5-352252", m_dependencyVO.getVersion());
        assertEquals("com.alcatel.axs.basic.isam.5.5", m_dependencyVO.getDependencies().get(0).getGroupId());
        assertEquals("isam", m_dependencyVO.getDependencies().get(0).getArtifactId());
        assertEquals("5.5-3_9.5-352214", m_dependencyVO.getDependencies().get(0).getVersion());
    }

    @Test
    public void testGetDependencySecondLevelInfo() {
        String data = "{\"type\":\"APC\",\"groupId\":\"com.alcatel.axs.apc.app.plugins.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-2_9.5-326999\"}";
        m_dependencyVO = m_searchDependencyHandler.getDependencySecondLevelInfo(data);
        assertEquals("com.alcatel.axs.apc.app.plugins.isam.5.4", m_dependencyVO.getGroupId());
        assertEquals("apc-isam-54-shub", m_dependencyVO.getArtifactId());
        assertEquals("5.4-2_9.5-326999", m_dependencyVO.getVersion());
        assertEquals("com.alcatel.axs.apc.app.plugins.fwk", m_dependencyVO.getDependencies().get(1).getGroupId());
        assertEquals("axs-apc-app-plugins-isam-fwk", m_dependencyVO.getDependencies().get(1).getArtifactId());
        assertEquals("1_9.5-326999", m_dependencyVO.getDependencies().get(1).getVersion());
    }
}
