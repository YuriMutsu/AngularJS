package util;

public class Constant {
    public static String PROXY_IP = "192.168.92.113";
    public static String PROXY_PORT = "9999";

    public static String URL_GET_GROUPID = "http://tiger.in.alcatel-lucent.com:9999/nexus/service/local/lucene/search?a=%s&v=%s";
    public static String URL_GET_CONTENT_POM_FILE = "http://tiger.in.alcatel-lucent.com:9999/nexus/content/groups/AMS/%s/%s/%s/%s.pom";
    public static String EMPTY_STRING = "";
    public static String GROUP_ID = "groupId";
    public static String ARTIFACT_ID = "artifactId";
    public static String VERSION = "version";
    public static String PROJECT_ELEMENT_TAG = "project";
    public static String DEPENDENCY_ELEMENT_TAG = "dependency";
    public static String ARTIFACT_ELEMENT_TAG = "artifact";

    public static String TYPE_CORE = "com.alcatel.axs.basic";
    public static String TYPE_APC = "com.alcatel.axs.apc";
    public static String TYPE_GSIP = "com.alcatel.axs.gsip";
    public static String TYPE_IDM = "com.alcatel.axs.idm";
    public static String TYPE_OIF = "com.alcatel.axs.oif";
    public static String TYPE_SPFE = "com.alcatel.axs.spfe";

    public static String CORE = "CORE";
    public static String APC = "APC";
    public static String GSIP = "GSIP";
    public static String IDM = "IDM";
    public static String OIF = "OIF";
    public static String SPFE = "SPFE";

    private static Integer SECOND = 1000;
    private static Integer MINUTE = 60 * 1000;
    public static Integer TIME_OUT = 30 * SECOND;

    public static String LINE_DOWN = "\r\n";
    public static String OPEN_DENPENDENCY = "<"+DEPENDENCY_ELEMENT_TAG+">";
    public static String CLOSE_DENPENDENCY = "</"+DEPENDENCY_ELEMENT_TAG+">";

    public static String OPEN_ARTIFACTID = "<"+ARTIFACT_ID+">";
    public static String CLOSE_ARTIFACTID = "</"+ARTIFACT_ID+">";

    public static String OPEN_GROUPID = "<"+GROUP_ID+">";
    public static String CLOSE_GROUPID = "</"+GROUP_ID+">";

    public static String OPEN_VERSION = "<"+VERSION+">";
    public static String CLOSE_VERSION = "</"+VERSION+">";

    public static String OPEN_PROJECT = "<"+PROJECT_ELEMENT_TAG+">";
    public static String CLOSE_PROJECT = "</"+PROJECT_ELEMENT_TAG+">";

    public static String OPEN_DENPENDENCIES = "<"+"dependencies"+">";
    public static String CLOSE_DENPENDENCIES = "</"+"dependencies"+">";

    public static String OPEN_CORE = "<"+CORE+">";
    public static String CLOSE_CORE = "</"+CORE+">";

    public static String OPEN_APC = "<"+APC+">";
    public static String CLOSE_APC = "</"+APC+">";

    public static String OPEN_GSIP = "<"+GSIP+">";
    public static String CLOSE_GSIP = "</"+GSIP+">";

    public static String OPEN_IDM = "<"+IDM+">";
    public static String CLOSE_IDM = "</"+IDM+">";

    public static String OPEN_SPFE = "<"+SPFE+">";
    public static String CLOSE_SPFE = "</"+SPFE+">";

    public static String TAB = "\t";
    public static String COM_ALCATEL = "com.alcatel";
}
