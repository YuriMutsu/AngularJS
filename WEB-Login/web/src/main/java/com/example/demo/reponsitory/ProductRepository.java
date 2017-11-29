package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.Products;

public interface ProductRepository extends CrudRepository<Products, Integer>{

}
