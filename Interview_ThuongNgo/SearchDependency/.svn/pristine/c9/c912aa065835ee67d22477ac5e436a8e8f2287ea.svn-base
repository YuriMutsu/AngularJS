package util;

import models.ResultCode;
import ninja.Result;
import ninja.Results;

public class ResultConverter {
    public static Result convertToResult(ResultCode type, Object data) {
        return Results.json().render("type", type).render("data", data);
    }
}
