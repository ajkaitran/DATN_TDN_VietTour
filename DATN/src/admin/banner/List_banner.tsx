import React from 'react'

interface Banner {
    id: number;
    banner_name: string;
    slogan: string;
    url: string;
    image: string;
    image_mobile: string;
    active: boolean;
    group_id: number;
    sort: number;
}

interface Props {
    banners: Banner[];
    errors: string[];
    successMessage?: string;
    errorMessage?: string;
}

const BannerManagement: React.FC<Props> = ({ banners, errors, successMessage, errorMessage }) => {
    return (
        <div>
            <h2 className="title_page">Quản lý Banner</h2>

            {/* Display errors */}
            {errors.length > 0 && (
                <div className="alert alert-danger">
                    <ul>
                        {errors.map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}

            {/* Display success message */}
            {successMessage && (
                <div className="alert alert-success">
                    {successMessage}
                </div>
            )}

            {/* Display error message */}
            {errorMessage && (
                <div className="alert alert-danger">
                    {errorMessage}
                </div>
            )}

            <div className="right-column">
                <div className="formcontent">
                    <div className="content p-3">
                        <table className="table table-striped mt-4">
                            <thead className="thead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên Banner</th>
                                    <th scope="col">Slogan</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Hình Ảnh Mobile</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Group ID</th>
                                    <th scope="col">Sort</th>
                                    <th scope="col">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                {banners.map((banner) => (
                                    <tr key={banner.id}>
                                        <td>{banner.id}</td>
                                        <td>{banner.banner_name}</td>
                                        <td>{banner.slogan}</td>
                                        <td><a href={banner.url} target="_blank" rel="noopener noreferrer">{banner.url}</a></td>
                                        <td>
                                            <img src={`storage / ${ banner.image } `} alt={banner.banner_name} width="100" />
                                        </td>
                                        <td>
                                            <img src={`storage / ${ banner.image_mobile } `} alt={`${ banner.banner_name } Mobile`} width="100" />
                                        </td>
                                        <td>{banner.active ? 'Kích hoạt' : 'Không kích hoạt'}</td>
                                        <td>{banner.group_id}</td>
                                        <td>{banner.sort}</td>
                                        <td>
                                            <a href={`/ banners / edit / ${ banner.id } `} className="btn btn-warning">Sửa</a>
                                            <form action={`/ banners / destroy / ${ banner.id }`} method="POST" style={{ display: 'inline' }}>
                                                {/* CSRF token and method for DELETE should be handled here */}
                                                <button type="submit" className="btn btn-danger" onClick={() => confirm('Bạn có chắc chắn muốn xóa banner này không?')}>Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default BannerManagement;


