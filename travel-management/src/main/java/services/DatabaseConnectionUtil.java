package services;

import com.mongodb.MongoClient;
import com.mongodb.client.MongoDatabase;


import static util.Constant.*;
/**
 * Created by tmtai on 8/11/2017.
 */

public class DatabaseConnectionUtil {
    public MongoClient client = new MongoClient(HOST, PORT);
 
    MongoDatabase db = client.getDatabase(DB_NAME);
    
}
