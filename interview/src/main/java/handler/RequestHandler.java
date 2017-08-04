package handler;

import org.json.JSONObject;
import util.Constant;

import java.util.HashMap;
import java.util.Map;

import static util.Constant.CORE;

public class RequestHandler {
    public Map<String, String> parseDataFromClient(String str) {
        RequestHandler requestHandler = new RequestHandler();
        JSONObject jsonObject = new JSONObject(str);
        Map<String, String> map = new HashMap<>();
        String type = jsonObject.get("type").toString();
        String groupId = jsonObject.get(Constant.GROUP_ID).toString();
        String artifactId = jsonObject.get(Constant.ARTIFACT_ID).toString();
        String version = jsonObject.get(Constant.VERSION).toString();

        String newArtifactId = requestHandler.newArtifactId(type, artifactId, version);
        map.put(Constant.GROUP_ID, groupId);
        map.put(Constant.ARTIFACT_ID, newArtifactId);
        map.put(Constant.VERSION, version);
        return map;
    }

    public String newArtifactId(String type, String artifactId, String version) {
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
                newArtifactId = "apc-" + artifactId + "-" + plugVer + "-shub";
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
