package service;

import org.apache.log4j.Logger;
import org.json.JSONObject;
import util.Constant;

import java.util.HashMap;
import java.util.Map;


public class RequestHandler {
    private static final Logger m_logger = Logger.getLogger(RequestHandler.class);

    public Map<String, String> parseDataFromClient(String str) {
        RequestHandler requestHandler = new RequestHandler();
        JSONObject jsonObject = new JSONObject(str);
        Map<String, String> hashMap = new HashMap<String, String>();
        String type = jsonObject.get("type").toString();
        String groupId = jsonObject.get(Constant.GROUP_ID).toString();
        String artifactId = jsonObject.get(Constant.ARTIFACT_ID).toString();
        String version = jsonObject.get(Constant.VERSION).toString();
        String newArtifactId = requestHandler.parser(type, artifactId, version);
        hashMap.put(Constant.GROUP_ID, groupId);
        hashMap.put(Constant.ARTIFACT_ID, newArtifactId);
        hashMap.put(Constant.VERSION, version);
        m_logger.info(String.format("Show next level of the dependencies with groupId: %s, artifactId: %s, version: %s ", groupId, newArtifactId, version));
        return hashMap;
    }

    public String parser(String type, String artifactId, String version) {
        String strPlugVer = version.split("-")[0];
        String plugVer = strPlugVer.replaceAll("\\D+", "");
        String newArtifactId = "";
        switch (type) {
            case "CORE":
                newArtifactId = "axs-" + artifactId + "-mobject-plugin";
                break;
            case "IDM":
                newArtifactId = "oss-inventory-mgr-" + artifactId + ",oss-inventory-mgr-" + artifactId + ".iacm";
                break;
            case "GSIP":
                newArtifactId = "axs-" + artifactId + plugVer + "-gsip-vap-plugin";
                break;
            case "APC":
                if (artifactId.equals("sx16f")) {
                    newArtifactId = "apc-" + artifactId + "." + strPlugVer;
                } else {
                    newArtifactId = "apc-" + artifactId + "-" + plugVer + "-shub";
                }
                break;
            case "SPFE":
                newArtifactId = "com.alcatel.axs.gui.spfe." + artifactId + "." + strPlugVer + ".test";
                break;
            default:
                newArtifactId = artifactId;
        }
        return newArtifactId;
    }
}
