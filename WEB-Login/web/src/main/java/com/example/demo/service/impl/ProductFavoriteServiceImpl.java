package com.example.demo.service.impl;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.ProductFavorite;
import com.example.demo.reponsitory.ProductFavoriteRepository;
import com.example.demo.service.ProductFavoriteService;

@Service
public class ProductFavoriteServiceImpl implements ProductFavoriteService{

	@Autowired
	private ProductFavoriteRepository repository;
	
	@Override
	public List<ProductFavorite> findAll() {
		return (List<ProductFavorite>) repository.findAll();
	}

	@Override
	public List<ProductFavorite> findByUsername(String username) {
		List<ProductFavorite> listAll = findAll();
		List<ProductFavorite> listResults = new ArrayList<>();
		for (ProductFavorite pro : listAll){
			if (pro.getAccounts().getUserName().equals(username)){
				listResults.add(pro);
			}
		}
		return listResults;
	}

	@Override
	public ProductFavorite findById(int id) {
		return repository.findOne(id);
	}

	@Override
	public void saveProductFavorite(ProductFavorite productFavorite) {
		repository.save(productFavorite);
	}

	@Override
	public void deleteProductFavorite(ProductFavorite productFavorite) {
		repository.delete(productFavorite);
	}

	@Override
	public void deleteAll() {
		repository.deleteAll();
	}

	@Override
	public boolean isExist(ProductFavorite productFavorite) {
		List<ProductFavorite> listResults = findByUsername(productFavorite.getAccounts().getUserName());
		for (ProductFavorite pro : listResults){
			if (pro.getProducts().getCode().equals(productFavorite.getProducts().getCode())){
				return true;
			}
		}
		return false;
	}

}
