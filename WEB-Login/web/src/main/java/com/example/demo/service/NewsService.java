package com.example.demo.service;

import java.util.List;

import com.example.demo.entity.News;
import com.example.demo.model.NewsInfo;

public interface NewsService {
	public List<News> findAll();
	public News findNews(int id);
	public News findNewsByTitle(String title);
	public void saveNews(News news);
	
	public List<NewsInfo> findAllNewsInfo();
	public NewsInfo findNewsInfo(int id);
	public NewsInfo findNewsInfoByTitle(String title);
}
