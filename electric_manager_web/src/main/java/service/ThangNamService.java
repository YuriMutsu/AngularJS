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

import java.util.ArrayList;
import java.util.List;

import static util.Constant.MA_NAM;
import static util.Constant.TABLE_NAM;

/**
 * Created by tranm on 08-Nov-17.
 */
public class ThangNamService extends DatabaseUtility{
    public Result getNam(){
        List<Nam> array = new ArrayList<Nam>();
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_NAM);
        FindIterable<Document> iterable = collection.find();
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                Nam nam = new Nam();
                nam.setManam(document.getString(MA_NAM));
                array.add(nam);
            }
        });
        mongoClient.close();
        return Results.json().render(array);
    }

    public Result getThang(){
        List<Thang> array = new ArrayList<Thang>();
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_NAM);
        FindIterable<Document> iterable = collection.find();
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                Thang thang = new Thang();
                thang.setMathang(document.getString(MA_NAM));
                array.add(thang);
            }
        });
        mongoClient.close();
        return Results.json().render(array);
    }
}
