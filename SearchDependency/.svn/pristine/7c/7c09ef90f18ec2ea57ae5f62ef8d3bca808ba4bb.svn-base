package util;

import org.junit.Before;
import org.junit.Test;

import static org.junit.Assert.assertTrue;

public class ConnectionUtilTest {
    private ConnectionUtil m_connectionUtil;

    @Before
    public void setUp(){
        m_connectionUtil = ConnectionUtil.getInstance();
    }

    @Test
    public void testGetDataFromUrl() throws Exception {
        System.setProperty("https.proxyHost", "10.10.10.10");
        System.setProperty("https.proxyPort", "8080");
        String result = m_connectionUtil.getDataFromUrl("https://www.google.com.vn/");
        assertTrue(result.contains("https://www.google.com.vn/intl/vi/options/"));
        assertTrue(result.contains("<a class=gb1 href=\"https://www.youtube.com/?gl=VN&tab=w1\">YouTube</a>"));
    }
}
