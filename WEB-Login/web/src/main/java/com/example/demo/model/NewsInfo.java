package com.example.demo.model;

import java.util.Date;

import com.example.demo.entity.News;

public class NewsInfo {
	private Integer id;
	private String title;
	private String content;
	private Date createDate;

	public NewsInfo() {
		super();
	}

	public NewsInfo(Integer id, String title, String content, Date createDate) {
		super();
		this.id = id;
		this.title = title;
		this.content = content;
		this.createDate = createDate;
	}

	public NewsInfo(News news) {
		super();
		this.id = news.getId();
		this.title = news.getTitle();
		this.content = news.getContent();
		this.createDate = news.getCreateDate();
	}

	
	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getContent() {
		return content;
	}

	public void setContent(String content) {
		this.content = content;
	}

	public Date getCreateDate() {
		return createDate;
	}

	public void setCreateDate(Date createDate) {
		this.createDate = createDate;
	}

}
