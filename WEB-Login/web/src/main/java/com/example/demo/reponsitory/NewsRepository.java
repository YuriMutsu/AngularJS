package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.News;

public interface NewsRepository extends CrudRepository<News, Integer>{

}
