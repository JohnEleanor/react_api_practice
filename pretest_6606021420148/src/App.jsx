import { useState, useEffect } from 'react'
import './App.css'

export default function App() {
  const [data, setData] = useState([]);
  const [province, setProvince] = useState([]);
  const [findProvince, setFind] = useState([]);


  const loadAlldata = async () => {
    try {
      const response = await fetch('http://127.0.0.1/jay_api/API.php/');
      const data = await response.json();
      setData(data);
    } catch (error) {
      console.log('[This Error] ' + error)
    }
  }

  const loadProvince = async () => {
    try {
      const response = await fetch('http://127.0.0.1/jay_api/API.php/province');
      const data = await response.json();
      setProvince(data);
    } catch (error) {
      console.log(error)
    }
  }

  const findProvice = async (e) => {
    const id = e.target.value;

    try {
      const response = await fetch(`http://127.0.0.1/jay_api/API.php/provinceid?id=${id}`);
      const data = await response.json();
      setFind(data);
      console.log(data);
    } catch (error) {
      console.log("error", error)
    }
  }


  useEffect(() => {
    loadAlldata();
    loadProvince();
  }, []);

  return (
    <>
      <center>
        <h1>My List</h1>
        <div className="drop-down" onChange={findProvice}>
          <select name="select_kub" >
            {
              province.map((data, index) => (
                <option value={data.province_id} key={index} >{data.name_th}</option>
              ))
            }
          </select>
        </div>
        <br />

        {
          findProvince == "" ? (
            <>
              <h1>จำนวน {data.length}</h1>
            <table border={1}>
              <tbody>
                <tr>
                  <th>ลำดับ</th>
                  <th>Zipcode</th>
                  <th>Provice</th>
                  <th>District</th>
                  <th>Subdistric</th>
                  <th>Location</th>
                </tr>
                {
                  data.map((data, index) => (
                    <tr key={index}>
                      <td>{index+1}</td>
                      <td>{data.zipcode}</td>
                      <td>{data.dis_name}</td>
                      <td>{data.pro_name}</td>
                      <td>{data.sub_name}</td>
                      <td>{data.lat}{data.long}</td>
                    </tr>
                  ))
                }
              </tbody>
            </table>
            </>
          ) : (
            <div>
              <h1>จำนวน {findProvince.length}</h1>
            <table border={1}>
              <tbody>
                <tr>
                  <th>ลำดับ</th>
                  <th>Zipcode</th>
                  <th>Provice</th>
                  <th>District</th>
                  <th>Subdistric</th>
                  <th>Location</th>
                </tr>
                {
                  findProvince.map((data, index) => (
                    <tr key={index}>
                      <td>{index+1}</td>
                      <td>{data.zipcode}</td>
                      <td>{data.pro_th}</td>
                      <td>{data.dis_th}</td>
                      <td>{data.sub_th}</td>
                      <td>{data.lat}{data.long}</td>
                    </tr>
                  ))
                }
              </tbody>
            </table>
            </div>
            
          )
        }


      </center>
    </>
  )
}
