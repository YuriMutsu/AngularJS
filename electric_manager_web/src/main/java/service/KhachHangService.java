package service;

import com.mongodb.Block;
import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import ninja.Result;
import ninja.Results;
import ninja.params.Param;
import org.bson.Document;
import org.bson.types.ObjectId;
import org.json.JSONArray;
import org.json.JSONObject;
import util.Constant.*;

import java.util.ArrayList;
import java.util.List;

import static util.Constant.*;

/**
 * Created by tranm on 29-Jul-17.
 */
public class KhachHangService extends DatabaseUtility {
    public Result getKhachHangStatistic(@Param("makv") String makv){
        JSONArray array = new JSONArray();
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection("khachhang");
        FindIterable<Document> iterable = collection.find(new Document("makv", makv));
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                System.out.println(document.toString());
                JSONObject json = new JSONObject();
                json.put(ID, document.getObjectId(MONGO_ID).toHexString());
                json.put(MA_KH, document.getString(MA_KH));
                json.put(TEN_KH, document.getString(TEN_KH));
                json.put(DIA_CHI, document.getString(DIA_CHI));
                json.put(ID_KHU_VUC, document.getString(ID_KHU_VUC));
                json.put(ID_DIEN_KE, document.getString(ID_DIEN_KE));
                json.put(CMND, document.getString(CMND));
                json.put(PHONE, document.getString(PHONE));
                json.put(GIOI_TINH, document.getString(GIOI_TINH));
                array.put(json);
            }
        });
        mongoClient.close();
        return Results.text().render(array);
    }

    public Result deleteKhachHang(@Param("id") String id){
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection("khachhang");
        collection.deleteOne(new Document(MONGO_ID, new ObjectId(id)));
        mongoClient.close();
        return Results.ok();
    }
}
