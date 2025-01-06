import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const SearchForm = () => {
    const [keyword, setKeyword] = useState('');
    const navigate = useNavigate();

    const handleSearch = async (e: any) => {
        e.preventDefault();
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/tour/search', {
                params: {
                    keyword: keyword
                }
            });
            console.log(response.data); // Xử lý dữ liệu trả về từ API ở đây
            navigate('/search-tour', { state: { data: response.data } }); // Chuyển tới trang SearchTour
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <form className="search-form" onSubmit={handleSearch}>
            <input
                type="text"
                placeholder="Nhập từ khóa tìm kiếm..."
                value={keyword}
                onChange={(e) => setKeyword(e.target.value)}
            />
            <button type="submit">Tìm kiếm</button>
        </form>
    );
};

export default SearchForm;
