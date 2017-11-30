package com.example.demo.controller;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.example.demo.entity.Accounts;
import com.example.demo.service.AccountService;

@Controller
public class UserController {
	
	private Logger m_logger = Logger.getLogger(UserController.class);
	@Autowired
	private AccountService accountService;
	
	 @Autowired
	    private PasswordEncoder passwordEncoder;
	@RequestMapping("/register")
	public String register() {
		return "register";
	}

	@PostMapping("/doRegister")
	public String doRegister(@RequestBody Accounts account) {
		account.setPassword(passwordEncoder.encode(account.getPassword()));
		accountService.save(account);
		m_logger.info("Save Account Success");
		
		return "redirect:/";
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
