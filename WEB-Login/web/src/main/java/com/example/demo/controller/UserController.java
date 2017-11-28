package com.example.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
public class UserController {
	@RequestMapping("/register")
	public String register() {
		return "register";
	}

	// GET: Show Login Page
	// GET: Hiển thị trang login
	@RequestMapping(value = { "/login" }, method = RequestMethod.GET)
	public String login() {
		return "login";
	}
	
	@RequestMapping("/changePassword")
	public String changePassword() {
		return "changePassword";
	}
}
