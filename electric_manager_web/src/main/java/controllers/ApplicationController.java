/**
 * Copyright (C) 2013 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package controllers;

import com.mongodb.Block;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import ninja.Result;
import ninja.Results;

import com.google.inject.Singleton;
import org.bson.Document;
import service.DatabaseUtility;

import java.util.ArrayList;
import java.util.List;


@Singleton
public class ApplicationController extends DatabaseUtility{

    public Result index() {

        return Results.html();

    }


    public Result getKhuVuc(){
        MongoCollection<Document> collection = db.getCollection("khuvuc");
        List<Document> list = new ArrayList<>();
        FindIterable<Document> iterable = collection.find();

        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                list.add(document);
            }
        });

        return Results.json().render(list);
    }

    public Result getThanhPho(){
        MongoCollection<Document> collection = db.getCollection("thanhpho");
        List<Document> list = new ArrayList<>();
        FindIterable<Document> iterable = collection.find();

        iterable.forEach(new Block<Document>() {
            @Override
            public void apply(Document document) {
                list.add(document);
            }
        });

        return Results.json().render(list);
    }
}