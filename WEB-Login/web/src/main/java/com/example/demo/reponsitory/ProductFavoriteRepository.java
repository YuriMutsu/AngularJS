package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.ProductFavorite;

public interface ProductFavoriteRepository extends CrudRepository<ProductFavorite, Integer>{

}
