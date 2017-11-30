package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.ProductDetails;

public interface ProductDetailRepository extends CrudRepository<ProductDetails, Integer>{

}
