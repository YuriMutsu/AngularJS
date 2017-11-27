package com.tmtai.web.banhang.thietbimaytinh.service;

import com.tmtai.web.banhang.thietbimaytinh.entity.Users;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UsernameNotFoundException;

import java.util.List;

/**
 * Created by tranm on 26-Nov-17.
 */
public interface UserService {
    void save(Users user);

    Users findById(int id);

    Users findByUsername(String username);

    UserDetails loadUserByUsername(String username) throws UsernameNotFoundException;

    List<Users> findAll();

    long count();

    void delete(int id);

    void deleteAll();

    boolean isExist(int id);

}
