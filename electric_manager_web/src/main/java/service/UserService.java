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

import static util.Constant.*;

/**
 * Created by tranm on 29-Jul-17.
 */
public class UserService extends DatabaseUtility {
    public Result getUser(@Param("code") String code) {
        MongoClient client = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_USERS);
        FindIterable<Document> iter = collection.find(new Document(CODE, code));
        JSONObject json = new JSONObject();
        iter.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                json.put(CODE, document.get(CODE));
                json.put(PASSWORD, document.get(PASSWORD));
                json.put(NAME, document.get(NAME));
                json.put(BIRTH_DAY, document.get(BIRTH_DAY));
                json.put(ADDRESS, document.get(ADDRESS));
                json.put(PHONE, document.get(PHONE));
                json.put(AVATAR, document.get(AVATAR));
                json.put(GENDER, document.get(GENDER));
                json.put(ROLE, document.get(ROLE));
                json.put(IS_ADMIN, document.get(IS_ADMIN));
                json.put(CMND, document.get(CMND));
            }
        });
        client.close();
        return Results.text().render(json);
    }

    public Result addUser(@Param("code") String code,
                          @Param("password") String password,
                          @Param("name") String name,
                          @Param("birthday") String birthday,
                          @Param("address") String address,
                          @Param("cmnd") String cmnd,
                          @Param("phone") String phone,
                          @Param("gender") String gender,
                          @Param("avatar") String avatar) {
        Document document = new Document()
                .append(CODE, code)
                .append(PASSWORD, password)
                .append(NAME, name)
                .append(BIRTH_DAY, birthday)
                .append(ADDRESS, address)
                .append(CMND, cmnd)
                .append(PHONE, phone)
                .append(GENDER, gender)
                .append(ROLE, "employee")
                .append(AVATAR, avatar)
                .append(IS_ADMIN, false);

        MongoClient client = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_USERS);
        collection.insertOne(document);
        client.close();
        return Results.redirect("/");
    }

    public Result deleteUser(@Param("code") String code) {
        MongoCollection collection = db.getCollection(TABLE_USERS);
        collection.deleteOne(new Document(MONGO_ID, new ObjectId(code)));
        return Results.ok();
    }

    public Result getAllUsers() {
        MongoCollection collection = db.getCollection(TABLE_USERS);
        JSONArray array = new JSONArray();
        FindIterable<Document> iter = collection.find();
        iter.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                JSONObject json = new JSONObject();
                json.put(CODE, document.get(CODE));
                json.put(PASSWORD, document.get(PASSWORD));
                json.put(NAME, document.get(NAME));
                json.put(BIRTH_DAY, document.get(BIRTH_DAY));
                json.put(ADDRESS, document.get(ADDRESS));
                json.put(PHONE, document.get(PHONE));
                json.put(AVATAR, document.get(AVATAR));
                json.put(GENDER, document.get(GENDER));
                json.put(ROLE, document.get(ROLE));
                json.put(IS_ADMIN, document.get(IS_ADMIN));
                json.put(CMND, document.get(CMND));

                array.put(json);
            }
        });
        return Results.text().render(array);
    }

    public Result newPassword(@Param("code") String code,
                              @Param("newpass") String newpass){
        MongoClient mongoClient = new MongoClient();
        MongoCollection collection = db.getCollection(TABLE_USERS);
        Document doc = new Document(MONGO_ID, new ObjectId(code));
        FindIterable<Document> iter = collection.find(doc);
        iter.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                document.replace(PASSWORD, newpass);
            }
        });
        mongoClient.close();
        return Results.ok();
    }

    public static String createDiaChi(String diachi, String makv) {
        MongoCollection kvCollection = db.getCollection(TABLE_KHU_VUC);
        Document khuvuc = (Document) kvCollection.find(new Document(MA_KHU_VUC, makv)).first();
        MongoCollection tpCollection = db.getCollection(TABLE_TINH_THANH_PHO);

        Document thanhpho = (Document) tpCollection.find(new Document(MA_THANH_PHO, khuvuc.getString(MA_THANH_PHO))).first();
        String dc = diachi + ", " + khuvuc.getString(TEN_KHU_VUC) + ", " + thanhpho.getString(TEN_TINH_TP);
        return dc;
    }
}
