package com.example.demo.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.News;
import com.example.demo.model.NewsInfo;
import com.example.demo.reponsitory.NewsRepository;
import com.example.demo.service.NewsService;

@Service
public class NewsServiceImpl implements NewsService{

	@Autowired
	private NewsRepository newsRepository;
	
	@Override
	public List<News> findAll() {
		return (List<News>) newsRepository.findAll();
	}
	
	@Override
	public News findNews(int id) {
		return newsRepository.findOne(id);
	}

	@Override
	public News findNewsByTitle(String title) {
		List<News> listNews = findAll();
		for (News news : listNews){
			if (news.getTitle().equals(title)){
				return news;
			}
		}
		return null;
	}

	@Override
	public void saveNews(News news) {
		newsRepository.save(news);
	}

	@Override
	public List<NewsInfo> findAllNewsInfo() {
		return null;
	}

	@Override
	public NewsInfo findNewsInfo(int id) {
		NewsInfo newsInfo = new NewsInfo(newsRepository.findOne(id));
		return newsInfo;
	}

	@Override
	public NewsInfo findNewsInfoByTitle(String title) {
		News news = findNewsByTitle(title);
		if (news == null){
			return null;
		}
		NewsInfo newsInfo = new NewsInfo(news);
		return newsInfo;
	}
}
