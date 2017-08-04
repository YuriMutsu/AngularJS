package util;

import org.jsoup.Connection;
import org.jsoup.Jsoup;

import java.io.IOException;
import java.net.InetSocketAddress;
import java.net.Proxy;
import static util.Constant.PROXY_IP;
import static util.Constant.PROXY_PORT;
import static util.Constant.TIME_OUT;

public class ConnectionUtil {
    private static ConnectionUtil instance;

    private ConnectionUtil(){

    }

    public static ConnectionUtil getInstance(){
        if (instance == null){
            instance = new ConnectionUtil();
        }
        return instance;
    }

    /**
     * getProxy = my PC proxy
     * */
    public Proxy getProxy(){
        int port;
        if (PROXY_IP == null || PROXY_PORT == null){
            return null;
        }
        port = Integer.parseInt(PROXY_PORT);

        Proxy proxy = new Proxy(Proxy.Type.HTTP, new InetSocketAddress(PROXY_IP, port));
        return proxy;
    }

    public String getDataFromURL(String url){
        Proxy proxy = getProxy();
        Connection connection = null;
        String data = "";
        if (proxy!= null){
            connection = Jsoup.connect(url).ignoreHttpErrors(true).ignoreContentType(true).maxBodySize(0).method(Connection.Method.GET).timeout(TIME_OUT).proxy(proxy);
        }else{
            connection = Jsoup.connect(url).ignoreHttpErrors(true).ignoreContentType(true).maxBodySize(0).method(Connection.Method.GET).timeout(TIME_OUT);
        }

        try {
            Connection.Response response = connection.execute();
            data = response.body();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return data;
    }
}
