package com.example.demo.service;

import java.util.List;

import com.example.demo.entity.ProductFavorite;

public interface ProductFavoriteService {
	List<ProductFavorite> findAll();
	List<ProductFavorite> findByUsername(String username);
	ProductFavorite findById(int id);
	void saveProductFavorite(ProductFavorite productFavorite);
	void deleteProductFavorite(ProductFavorite productFavorite);
	void deleteAll();
	boolean isExist(ProductFavorite productFavorite);
}
