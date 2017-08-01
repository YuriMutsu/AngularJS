package service;


import org.junit.Before;
import org.junit.Test;
import util.Constant;

import java.util.HashMap;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertNull;
import static org.junit.Assert.assertTrue;


public class DependencySearcherImplTest {
    private DependencySearcherImpl m_dependencySearcher;


    @Before
    public void setUp() {
        m_dependencySearcher = new DependencySearcherImpl();
    }

    @Test
    public void testGetArtifactIdVersion() {
        String binaryName = "plugin-combo-isam-3.7-1.0_9.6-347546.bin";
        assertEquals("comboisam", m_dependencySearcher.getArtifactIdVersion(binaryName).get(Constant.ARTIFACT_ID));
        assertEquals("3.7-1_9.6-347546", m_dependencySearcher.getArtifactIdVersion(binaryName).get(Constant.VERSION));
        String binaryName1 = "plugin-combo-isam-3.7-1.0_9.6-347546";
        HashMap<String, String> hashMapArtifactIdVersion = m_dependencySearcher.getArtifactIdVersion(binaryName1);
        assertNull(hashMapArtifactIdVersion.get(Constant.ARTIFACT_ID));
        assertNull(hashMapArtifactIdVersion.get(Constant.VERSION));
    }

    @Test
    public void testGetPomContentFirstLevel() {
        String artifactId = "comboisam";
        String version = "3.7-1_9.6-347546";
        String result = m_dependencySearcher.getPomContent(artifactId, version);
        assertTrue(result.contains("<artifactId>comboisam</artifactId>"));
        assertTrue(result.contains("<groupId>com.alcatel.axs.combo.plugins.isam.3.7</groupId>"));
    }

    @Test
    public void testGetPomContentChildLevel() {
        String groupId = "com.alcatel.axs.basic.isam.5.4";
        String artifactId = "isam";
        String version = "5.4-2_9.5-338736";
        String result = m_dependencySearcher.getPomContent(groupId, artifactId, version);
        assertTrue(result.contains("<modelVersion>4.0.0</modelVersion>"));
        assertTrue(result.contains("<groupId>com.alcatel.axs.basic.isam.5.4</groupId>"));
    }
}

