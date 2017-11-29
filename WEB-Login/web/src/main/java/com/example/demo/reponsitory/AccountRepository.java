package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.Accounts;

public interface AccountRepository extends CrudRepository<Accounts, Integer>{

}
