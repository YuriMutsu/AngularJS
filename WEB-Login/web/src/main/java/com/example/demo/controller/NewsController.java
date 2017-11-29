package com.example.demo.controller;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.model.NewsInfo;
import com.example.demo.service.NewsService;

@Controller
public class NewsController {
	
	private Logger m_logger = Logger.getLogger(NewsController.class);
	
	
	@Autowired 
	private NewsService newsService;
	
	@RequestMapping("/newsInfo")
	public String newsInfo(Model model, @RequestParam("title") String title){
		m_logger.info("Title : " + title);
		NewsInfo newsInfo = newsService.findNewsInfoByTitle(title);
		model.addAttribute("newsInfo", newsInfo);
		return "newsInfo";
	}
}
