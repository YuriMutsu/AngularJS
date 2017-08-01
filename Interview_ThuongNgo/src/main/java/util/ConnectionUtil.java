package util;

import org.apache.log4j.Logger;
import org.jsoup.Connection;
import org.jsoup.Jsoup;

import java.io.IOException;
import java.net.InetSocketAddress;
import java.net.Proxy;

import static util.Constant.PROXY_IP;
import static util.Constant.PROXY_PORT;

public class ConnectionUtil {
    private static final Logger m_logger = Logger.getLogger(ConnectionUtil.class);
    private static ConnectionUtil m_connectionUtil;

    private ConnectionUtil() {
    }

    public static ConnectionUtil getInstance() {
        if (m_connectionUtil == null) {
            synchronized (ConnectionUtil.class) {
                if (m_connectionUtil == null) {
                    m_connectionUtil = new ConnectionUtil();
                }
            }
        }
        return m_connectionUtil;
    }

    public Proxy getProxy() {
        int proxyPort;
        if (PROXY_IP == null || PROXY_PORT == null) {
            return null;
        }
        try {
            proxyPort = Integer.parseInt(PROXY_PORT);
        } catch (NumberFormatException e) {
            m_logger.error(String.format("Incorrect proxy port address %s", e, PROXY_PORT));
            return null;
        }
        Proxy proxy = new Proxy(java.net.Proxy.Type.HTTP, new InetSocketAddress(PROXY_IP, proxyPort));
        return proxy;
    }

    public String getDataFromUrl(String urlConnection) throws IOException {
        Connection connection = Jsoup.connect(urlConnection).ignoreHttpErrors(true).ignoreContentType(true).maxBodySize(0).method(Connection.Method.GET).timeout(0);
        Connection.Response response = connection.execute();
        Proxy proxy = getProxy();
        if (proxy != null) {
            connection.proxy(proxy);
        }
        String data = response.body();
        return data;
    }
}
