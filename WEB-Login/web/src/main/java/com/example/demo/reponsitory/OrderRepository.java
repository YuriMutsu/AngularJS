package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.Orders;

public interface OrderRepository extends CrudRepository<Orders, Integer>{

}
