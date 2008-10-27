require 'test_helper'

class HubsControllerTest < ActionController::TestCase
  def test_should_get_index
    get :index
    assert_response :success
    assert_not_nil assigns(:hubs)
  end

  def test_should_get_new
    get :new
    assert_response :success
  end

  def test_should_create_hub
    assert_difference('Hub.count') do
      post :create, :hub => { :hub_number => '11111' }
    end

    assert_redirected_to hub_path(assigns(:hub))
  end

  def test_should_show_hub
    get :show, :id => hubs(:one).id
    assert_response :success
  end

  def test_should_get_edit
    get :edit, :id => hubs(:one).id
    assert_response :success
  end

  def test_should_update_hub
    put :update, :id => hubs(:one).id, :hub => { }
    assert_redirected_to hub_path(assigns(:hub))
  end

  def test_should_destroy_hub
    assert_difference('Hub.count', -1) do
      delete :destroy, :id => hubs(:one).id
    end

    assert_redirected_to hubs_path
  end
end
