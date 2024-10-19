import time
import requests
from datetime import datetime
import json

import socket
import re

import os

# 设置你的Client ID和Client Secret
client_id = 'xrunsfzqxqqpo91ind4ptsvayxbs3j'
client_secret = 'wm40par0pj52jqhby6edzrnux5w3am'

# 设置你要查询的直播主的用户名
username = 'sweetily'


def get_access_token():
    # 获取访问令牌（App Access Token）
    auth_url = 'https://id.twitch.tv/oauth2/token'
    auth_params = {
        'client_id': client_id,
        'client_secret': client_secret,
        'grant_type': 'client_credentials'
    }
    auth_response = requests.post(auth_url, params=auth_params)
    auth_data = auth_response.json()
    access_token = auth_data['access_token']
    
    # 使用访问令牌查询直播主的关注者数量
    headers = {
        'Client-ID': client_id,
        'Authorization': f'Bearer {access_token}'
    }
    return headers


def get_base_info(username, headers):
    info_url = f'https://api.twitch.tv/helix/users?login={username}'
    info_response = requests.get(info_url, headers=headers)
    info_data = info_response.json()
    # print(info_data)

    channel_id = info_data['data'][0]['id']
    display_name = info_data['data'][0]['display_name']
    live_url = 'https://www.twitch.tv/' + info_data['data'][0]['login']
    description = info_data['data'][0]['description']
    avatar = info_data['data'][0]['profile_image_url']
    offline_bg = info_data['data'][0]['offline_image_url']
    created_at = info_data['data'][0]['created_at']
    base_info = {'channel_id': channel_id, 'display_name': display_name, 'live_url': live_url,
                 'description': description, 'avatar': avatar, 'offline_bg': offline_bg, 'created_at': created_at}
    return base_info


def get_follower_count(channel_id, headers):
    follow_url = f'https://api.twitch.tv/helix/channels/followers?broadcaster_id={channel_id}'
    follow_response = requests.get(follow_url, headers=headers)
    follow_data = follow_response.json()
    print(follow_data)

    # 解析响应数据并获取关注者数量
    follower_count = {'fans': follow_data['total'],
                      'time': datetime.now().strftime("%Y-%m-%d %H:%M:%S")}
    return follower_count


def get_subscriber_count(channel_id, headers):  # 需要user token，废弃
    url = f"https://api.twitch.tv/helix/subscriptions?broadcaster_id={channel_id}"
    response = requests.get(url, headers=headers)
    subscriber_data = response.json()
    print(subscriber_data)

    subscriber_count = {'subscribers': subscriber_data.get("total", 0),
                        'time': datetime.now().strftime("%Y-%m-%d %H:%M:%S")}
    return subscriber_count


def get_viewer_count(username, headers):
    viewer_url = f'https://api.twitch.tv/helix/streams?user_login={username}'
    response = requests.get(viewer_url, headers=headers)
    viewer_data = response.json()
    # print(viewer_data)

    if len(viewer_data['data']) != 0:
        viewer_count = {'viewers': viewer_data['data'][0]['viewer_count'],
                        'status': 1,
                        'time': datetime.now().strftime("%Y-%m-%d %H:%M:%S")}
    else:
        viewer_count = {'viewers': 0,
                        'status': 0,
                        'time': datetime.now().strftime("%Y-%m-%d %H:%M:%S")}
    return viewer_count


def initialize_file(file):
    # 检查文件是否存在，如果不存在则创建并初始化为空数组
    if not os.path.exists(file):
        with open(file, 'w') as f:
            json.dump([], f)


def manage_data_file():
    # 检查data.json大小，超过3MB则删除最早的数据
    file_path = './data/data.json'
    while os.path.getsize(file_path) > 3 * 1024 * 1024:  # 3MB
        with open(file_path, 'r') as f:
            file_data = json.load(f)

        # 删除最早的数据
        if file_data:
            file_data.pop(0)

        with open(file_path, 'w') as f:
            json.dump(file_data, f)


def write_json(data, file):
    # 读取文件内容
    with open(file, 'r') as f:
        file_data = json.load(f)

    # 将数据添加到文件内容
    file_data.append(data)

    # 将更新后的内容写回文件
    with open(file, 'w') as f:
        json.dump(file_data, f)


# 初始化文件
initialize_file('./data/forever_data.json')
initialize_file('./data/data.json')

# 打印关注者信息
headers = get_access_token()
base_info = get_base_info(username, headers)
channel_id = base_info['channel_id']
print(f"{base_info['avatar']}\n{base_info['display_name']} ({base_info['live_url']})\n{base_info['description']}\nTA于{base_info['created_at']}加入Twitch")
print('========================')
with open('./data/profile.json', 'w') as f:
    json.dump(base_info, f)

# 循环打印关注者关注者数与同接数
def main():
    while True:
        headers = get_access_token()
        follow_result = get_follower_count(channel_id, headers)
        # subscriber_result = get_subscriber_count(channel_id, headers)
        viewer_result = get_viewer_count(username, headers)
        print(f"时间：{follow_result['time']} 关注者数量：{follow_result['fans']}")
        # print(f"时间：{subscriber_result['time']} 订阅者数量：{subscriber_result['subscribers']}")
        if viewer_result['status'] == 1:
            print(f"时间：{viewer_result['time']} 同接数：{viewer_result['viewers']}")
        else:
            print(f"时间：{viewer_result['time']} 未直播")
        print('------------------------')
        data = {'time': follow_result['time'], 'fans': follow_result['fans'], 'viewer': viewer_result['viewers'], 'status': viewer_result['status']}
        
        # 写入数据到两个文件
        write_json(data, './data/forever_data.json')
        write_json(data, './data/data.json')

        # 管理data.json的大小
        manage_data_file()
        
        time.sleep(720)

while True:
    try:
        main()
    except Exception as e:
        print("发生错误:", str(e))
        continue
    else:
        break
