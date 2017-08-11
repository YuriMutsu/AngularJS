package controllers;

import models.Schedule;
import ninja.Result;
import ninja.Results;
import services.ScheduleService;

import java.util.List;

public class ScheduleController {
    public Result getAll(){
        List<Schedule> list = ScheduleService.getInstance().getAll();

        return Results.json().render(list);
    }


}
