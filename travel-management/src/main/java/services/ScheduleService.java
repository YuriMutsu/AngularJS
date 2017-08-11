package services;

import com.mongodb.Block;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;

import models.Schedule;

import org.bson.Document;

import java.util.ArrayList;
import java.util.List;
import static util.Constant.TABLE_SCHEDULE;

/**
 * Created by tmtai on 8/11/2017.
 */

public class ScheduleService extends DatabaseConnectionUtil {
    private static ScheduleService instance = new ScheduleService();

    public static ScheduleService getInstance(){
        return instance;
    }

    public List<Schedule> getAll(){
        final List<Schedule> list = new ArrayList<>();
        MongoCollection<Document> collection = db.getCollection(TABLE_SCHEDULE);
        FindIterable<Document> iterable = collection.find();
        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                list.add(new Schedule(document));
            }
        });
        return list;
    }

}
