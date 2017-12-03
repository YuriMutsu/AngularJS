package com.example.demo.controller;

import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

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
	
	@RequestMapping("/#/news")
	public String news2() {
		return "login";
	}
}
