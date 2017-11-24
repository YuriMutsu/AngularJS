package com.example.demo.controller;

import com.example.demo.entity.User;
import com.example.demo.service.UserService;
import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

/**
 * Created by tmtai on 11/24/2017.
 */

@Controller
public class LoginController {
    private static Logger m_logger = Logger.getLogger(LoginController.class);

    @Autowired
    private UserService userService;

    @PostMapping("/doLogin")
    public String doLogin(@RequestParam("username") String username,
                          @RequestParam("password") String password){
        m_logger.info("Start login with user : " + username);
        User usr = userService.findByUsername(username);
        if (usr == null){
            m_logger.info("User is not exist.");
            return "redirect:/login";
        }

        if (usr.getPassword().equals(password)){
            m_logger.info("Login Susscess.");
            return "redirect:/";
        }
        return "1";
    }
}
