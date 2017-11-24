package com.example.demo;

import org.springframework.beans.BeansException;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ApplicationContext;
import org.springframework.context.ApplicationContextAware;

@SpringBootApplication

public class WebApplication implements ApplicationContextAware{

	private static ApplicationContext applicationContext;

	public static void main(String[] args){
		SpringApplication.run(WebApplication.class, args);
	}
	public static ApplicationContext getApplicatinContext() {
		return applicationContext;
	}
	
	@Override
	public void setApplicationContext(ApplicationContext context) throws BeansException {
		applicationContext = context;		
	}
	
	
}
