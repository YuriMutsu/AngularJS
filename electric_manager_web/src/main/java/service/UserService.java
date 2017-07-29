package service;

import com.mongodb.client.MongoCollection;
import ninja.Result;

/**
 * Created by tranm on 29-Jul-17.
 */
public class UserService extends DatabaseUtility{
    public Result getUser(){
        MongoCollection collection = db.getCollection("users");
        return null;
    }
}
