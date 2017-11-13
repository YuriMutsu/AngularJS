package service;

import com.mongodb.Block;
import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import models.Nam;
import models.Thang;
import ninja.Result;
import ninja.Results;
import org.bson.Document;
import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import static util.Constant.*;

/**
 * Created by tranm on 08-Nov-17.
 */
public class ThangNamService extends DatabaseUtility{
    public Result getNam(){
        JSONArray array = new JSONArray();
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_NAM);
        FindIterable<Document> iterable = collection.find();
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                JSONObject json = new JSONObject();
                json.put(MA_NAM, document.getString(MA_NAM));
                array.put(json);
            }
        });
        mongoClient.close();
        return Results.text().render(array);
    }

    public Result getThang(){
        JSONArray array = new JSONArray();
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_THANG);
        FindIterable<Document> iterable = collection.find();
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                JSONObject json = new JSONObject();
                json.put(MA_THANG, document.getString(MA_THANG));
                array.put(json);
            }
        });
        mongoClient.close();
        return Results.text().render(array);
    }
}
