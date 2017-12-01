package com.example.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
public class MainController {
	
	@RequestMapping("/403")
	public String error403() {
		return "/error/403";
	}

	@RequestMapping({"/", "/home"})
	public String home() {
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
