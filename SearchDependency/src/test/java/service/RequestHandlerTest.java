package service;

import org.junit.Before;
import org.junit.Test;
import util.Constant;

import java.util.HashMap;
import java.util.Map;

import static org.junit.Assert.assertEquals;

public class RequestHandlerTest {
    private RequestHandler m_requestHandler;


    @Before
    public void setUp() {
        m_requestHandler = new RequestHandler();
    }

    @Test
    public void testParseDataFromClientForAPCPlug() {
        Map<String, String> hashMap = new HashMap<String, String>();
        String strTest = "{\"type\":\"APC\",\"groupId\":\"com.alcatel.axs.apc.app.plugins.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-2_9.5-326999\"}";
        hashMap = m_requestHandler.parseDataFromClient(strTest);
        assertEquals("com.alcatel.axs.apc.app.plugins.isam.5.4", hashMap.get(Constant.GROUP_ID));
        assertEquals("apc-isam-54-shub", hashMap.get(Constant.ARTIFACT_ID));
        assertEquals("5.4-2_9.5-326999", hashMap.get(Constant.VERSION));
    }

    @Test
    public void testParseDataFromClientForGSIPPlug() {
        Map<String, String> hashMap = new HashMap<String, String>();
        String strTest = "{\"type\":\"GSIP\",\"groupId\":\"com.alcatel.axs.gsip.app.plugins.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-1_9.5-324432\"}";
        hashMap = m_requestHandler.parseDataFromClient(strTest);
        assertEquals("com.alcatel.axs.gsip.app.plugins.isam.5.4", hashMap.get(Constant.GROUP_ID));
        assertEquals("axs-isam54-gsip-vap-plugin", hashMap.get(Constant.ARTIFACT_ID));
        assertEquals("5.4-1_9.5-324432", hashMap.get(Constant.VERSION));
    }

    @Test
    public void testParseDataFromClientForCOREPlug() {
        Map<String, String> hashMap = new HashMap<String, String>();
        String strTest = "{\"type\":\"CORE\",\"groupId\":\"com.alcatel.axs.basic.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-2_9.5-324432\"}";
        hashMap = m_requestHandler.parseDataFromClient(strTest);
        assertEquals("com.alcatel.axs.basic.isam.5.4", hashMap.get(Constant.GROUP_ID));
        assertEquals("axs-isam-mobject-plugin", hashMap.get(Constant.ARTIFACT_ID));
        assertEquals("5.4-2_9.5-324432", hashMap.get(Constant.VERSION));
    }

    @Test
    public void testParseDataFromClientForIDMPlug() {
        Map<String, String> hashMap = new HashMap<String, String>();
        String strTest = "{\"type\":\"IDM\",\"groupId\":\"com.alcatel.axs.idm.app.plugins.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-1_9.5-324432\"}";
        hashMap = m_requestHandler.parseDataFromClient(strTest);
        assertEquals("com.alcatel.axs.idm.app.plugins.isam.5.4", hashMap.get(Constant.GROUP_ID));
        assertEquals("oss-inventory-mgr-isam,oss-inventory-mgr-isam.iacm", hashMap.get(Constant.ARTIFACT_ID));
        assertEquals("5.4-1_9.5-324432", hashMap.get(Constant.VERSION));
    }

    @Test
    public void testParseDataFromClientForSPFEPlug() {
        Map<String, String> hashMap = new HashMap<String, String>();
        String strTest = "{\"type\":\"SPFE\",\"groupId\":\"com.alcatel.axs.spfe.app.plugins.isam.5.4\",\"artifactId\":\"isam\",\"version\":\"5.4-2_9.5-326520\"}";
        hashMap = m_requestHandler.parseDataFromClient(strTest);
        assertEquals("com.alcatel.axs.spfe.app.plugins.isam.5.4", hashMap.get(Constant.GROUP_ID));
        assertEquals("com.alcatel.axs.gui.spfe.isam.5.4.test", hashMap.get(Constant.ARTIFACT_ID));
        assertEquals("5.4-2_9.5-326520", hashMap.get(Constant.VERSION));
    }

    @Test
    public void testParserForCORE() {
        String type = "CORE";
        String artifact = "isam";
        String version = "5.4-2_9.5-326520";
        String newArtifact = m_requestHandler.parser(type, artifact, version);
        assertEquals("axs-isam-mobject-plugin", newArtifact);
    }

    @Test
    public void testParserForIDM() {
        String type = "IDM";
        String artifactIDM = "isam";
        String version = "5.4-2_9.5-326520";
        String newArtifact = m_requestHandler.parser(type, artifactIDM, version);
        assertEquals("oss-inventory-mgr-isam,oss-inventory-mgr-isam.iacm", newArtifact);
    }

    @Test
    public void testParserForAPC() {
        String type = "APC";
        String artifactAPC = "isam";
        String version = "5.4-2_9.5-326520";
        String newArtifact = m_requestHandler.parser(type, artifactAPC, version);
        assertEquals("apc-isam-54-shub", newArtifact);
    }

    @Test
    public void testParserForGSIP() {
        String type = "GSIP";
        String artifactGSIP = "isam";
        String version = "5.4-2_9.5-326520";
        String newArtifact = m_requestHandler.parser(type, artifactGSIP, version);
        assertEquals("axs-isam54-gsip-vap-plugin", newArtifact);
    }

    @Test
    public void testParserForSPFE() {
        String type = "SPFE";
        String artifactSPFE = "isam";
        String version = "5.4-2_9.5-326520";
        String newArtifact = m_requestHandler.parser(type, artifactSPFE, version);
        assertEquals("com.alcatel.axs.gui.spfe.isam.5.4.test", newArtifact);
    }


}
