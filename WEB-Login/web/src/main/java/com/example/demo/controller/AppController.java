package com.example.demo.controller;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Cookie;

import org.apache.log4j.Logger;
import org.springframework.http.HttpRequest;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.web.authentication.logout.SecurityContextLogoutHandler;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
public class AppController {

	private Logger m_logger = Logger.getLogger(AppController.class);

	@RequestMapping({"/", "/home", "/admin", "member"})
	String welcomPage(HttpServletResponse response){
		return "index";
	}
	
	@RequestMapping("/register")
	String register(){
		return "register";
	}

	@RequestMapping("/admin") 
    public String admin() {
        return "admin";
    }

	@RequestMapping("/403")
    public String accessDenied() {
        return "403";
    }

	@RequestMapping("/login") 
    public String getLogin() {
        return "login";
    }
	
	@RequestMapping("/logout")
	public String logout(HttpServletRequest request, HttpServletResponse response) {
	    Authentication auth = SecurityContextHolder.getContext().getAuthentication();
	    if (auth != null) {
	        new SecurityContextLogoutHandler().logout(request, response, auth);
	    }
	    return "redirect:/";
	}

	@RequestMapping("/addUser")
	public String addUser(){
		return "addUser";
	}

	@RequestMapping("/head")
	public String head(){
		return "head";
	}
}
