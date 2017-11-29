package com.example.demo.controller.rest;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.News;
import com.example.demo.service.NewsService;
@RestController
@RequestMapping("/rest")
public class RestNewsController {

	private Logger m_logger = Logger.getLogger(RestNewsController.class);
	
	@Autowired
	private NewsService newsService;
	
	@RequestMapping("/allNews")
	public ResponseEntity<List<News>> getAll(){
		List<News> listNews = newsService.findAll();
		m_logger.info("List News : " + listNews);
		return new ResponseEntity<List<News>>(listNews, HttpStatus.OK);
	}
	
	@RequestMapping("/16News")
	public ResponseEntity<List<News>> getAllNews(){
		List<News> listNews = newsService.findAll();
		int size = listNews.size();
		List<News> listNews16 = new ArrayList<News>();
		
		for (int i=0;i<16;i++){
			listNews16.add(listNews.get(size-(i+1)));
		}
		
		return new ResponseEntity<List<News>>(listNews16, HttpStatus.OK);
	}
	
	@RequestMapping("/news/{id}")
	public ResponseEntity<News> getNews(@PathVariable(value = "id") int id){
		News news = newsService.findNews(id);
		m_logger.info("News : " + news);
		return new ResponseEntity<News>(news, HttpStatus.OK);
	}
	
	@RequestMapping("/news")
	public ResponseEntity<News> getNews(@RequestParam("title") String title){
		m_logger.info("title : " + title);
		News news = newsService.findNewsByTitle(title);
		
		return new ResponseEntity<News>(news, HttpStatus.OK);
	}
	
	@RequestMapping("/news/image")
	public void getNewsImage(HttpServletRequest request, HttpServletResponse response, @RequestParam("title") String title) throws IOException{
		m_logger.info("title : " + title);
		
		m_logger.info("request : " + request);
		
		News news = newsService.findNewsByTitle(title);
		
		request.getSession().setAttribute("news", news);
		
//		request.getSession().removeAttribute("news");
		
		if (news != null && news.getImage() != null) {
			response.setContentType("image/jpeg, image/jpg, image/png, image/gif");
			response.getOutputStream().write(news.getImage());
		}
		response.getOutputStream().close();
	}
}
