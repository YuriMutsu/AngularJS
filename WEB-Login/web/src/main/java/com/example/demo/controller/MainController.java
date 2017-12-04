package com.example.demo.controller;

import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.demo.entity.Accounts;
import com.example.demo.model.CartInfo;
import com.example.demo.model.CustomerInfo;
import com.example.demo.service.AccountService;
import com.example.demo.utils.Utils;

@Controller
public class MainController {

	private Logger m_logger = Logger.getLogger(MainController.class);
	
	@RequestMapping("/403")
	public String error403() {
		return "/error/403";
	}

	@RequestMapping({"/", "/home"})
	public String home(HttpServletRequest request) {
		Utils.getNumberProductOfCart(request);
		Utils.getCartInSession(request);
		return "index";
	}

	@RequestMapping("/pagination")
	public String pagination() {
		return "pagination";
	}
	
	@RequestMapping("/news")
	public String news() {
		return "news";
	}
	
	@RequestMapping("/pay")
	public String pay() {
		return "pay";
	}
}
